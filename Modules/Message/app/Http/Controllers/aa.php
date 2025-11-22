<?php
//use App\Clients\ApiAlphiClient; use App\Clients\BotEvolutionClient; use App\Clients\EvolutionClient;
use App\Events\WebHookWhatsapp;
use App\Models\Attendance;
use App\Models\Company;
use App\Models\CompanyParam;
use App\Models\Message;
use App\Models\ServiceWa;
use Carbon\Carbon;

class EvolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Company::query()->first();
        $company->channel = tenancy()->tenant->id;
        $company->channel_name = 1;
        $company->save();

        $companyParam = CompanyParam::query()->first();
        if ($companyParam->type_bot === 'NONE') {
            $companyParam->type_bot = 'MSG';
            $companyParam->save();
        }

        return view('bot.index', compact('company', 'companyParam'));
    }

    public function typeBot(Request $request)
    {
        $companyParam = CompanyParam::query()->first();
        $companyParam->type_bot = $request->type_bot;
        if ($request->type_bot === 'IA') {
            $companyParam->enable_bot = 1;
        }
        $companyParam->save();

        return response()->json([], 200);
    }

    public function hab(Request $request)
    {
        $companyParam = CompanyParam::query()->first();
        $companyParam->enable_bot = (int) $request->hab;
        $companyParam->save();

        return response()->json([], 200);
    }

    public function habAttendance(Request $request)
    {
        $atendance = Attendance::query()->where('id', $request->id)->first();
        $atendance->enable_bot = (int) $request->hab;
        $atendance->save();

        return response()->json([], 200);
    }

    public function attendanceList(Request $request)
    {
        $attendances = Attendance::query()->orderBy('last_message_at', 'desc')->get();

        return response()->json($attendances, 200);
    }

    public function attendanceUnic($id)
    {
        $attendance = Attendance::query()->where('phone', $id)->first();
        $messages = Message::query()->where('attendance_id', $attendance->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'attendance' => $attendance,
            'messages' => $messages,
        ], 200);
    }

    public function webhook(Request $request)
    {
        event(new WebHookWhatsapp($request->all(), 'whatsapp'));
        $this->checkSendFirstMessage($request);

        return 'OK';
    }

    public function checkSendFirstMessage(Request $request)
    {
        if ($request->event != 'messages.upsert') {
            return 'nothing';
        }

        $ret = $request->all();

        $phone = $ret['data']['key']['remoteJid'];
        $name = $ret['data']['pushName'] ?? '';
        $msg = $ret['data']['messageType'] ?? '';
        if ($ret['data']['messageType'] == 'extendedTextMessage') {
            $msg = $ret['data']['message']['extendedTextMessage']['text'];
        }
        if ($ret['data']['messageType'] == 'conversation') {
            $msg = $ret['data']['message']['conversation'];
        }
        $fromMe = $ret['data']['key']['fromMe'];
        $group = isset($ret['data']['key']['participant']) ? true : false;

        if ($phone === 'status@broadcast') {
            return 'nothing';
        }

        if ($group) {
            return 'nothing';
        }

        if ($fromMe) {
            return 'nothing';
        }

        $company = Company::query()->first();

        if (! $company) {
            return 'Não encontrou empresa';
        }

        if ($company->channel === 'milao') {
            try {
                $robo = new ApiAlphiClient();
                $rodoAnswer = $robo->answer([
                    'phone' => $phone,
                    'line' => $msg,
                ])->json()['answer'];
            } catch (\Exception $e) {
                \Log::error('Erro ao enviar mensagem: ' . $e->getMessage());

                return 'Error';
            }

            $evolutionClient = new EvolutionClient();

            return $evolutionClient->sendMessageTxt($company->channel, [
                'number' => $phone,
                'options' => [
                    'delay' => 1200,
                    'presence' => 'composing',
                ],
                'textMessage' => [
                    'text' => $rodoAnswer,
                ],
            ])->json();
        }

        if ($company->first_message_whatsapp == '' || $company->first_message_whatsapp == null) {
            return 'mensagem não preenchida';
        }

        $serviceWa = ServiceWa::where('phone', $phone)->orderBy('created_at', 'desc')->first();

        if (! $serviceWa) {
            $this->sentFirstMessage($phone, $msg, $name, $company);

            return 'message sent';
        }

        $now = Carbon::now()->format('Y-m-d');
        $dt1 = Carbon::parse($serviceWa->created_at)->format('Y-m-d');

        if ($dt1 < $now) {
            $this->sentFirstMessage($phone, $msg, $name, $company);

            return 'message sent';
        }

        return 'nothing';
    }

    public function sentFirstMessage($phone, $msg, $name, $company): void
    {
        try {
            $text = $company->first_message_whatsapp;
            $this->sendMessageCustomer($phone, $text);
            ServiceWa::where('phone', $phone)->delete();
            $serviceWa = new ServiceWa();
            $serviceWa->phone = $phone;
            $serviceWa->msg = $msg;
            $serviceWa->name = $name;
            $serviceWa->save();
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar mensagem: ' . $e->getMessage());
        }
    }

    public function sendMessageCustomer($from, $txt)
    {
        if ($this->validarNumeroCelular($from)) {
            $instance = tenancy()->tenant->id;
            $evolutionClient = new BotEvolutionClient();

            return $evolutionClient->sendMessageTxt($instance, [
                'number' => $this->adicionarDDI($from),
                'options' => [
                    'delay' => 1200,
                    'presence' => 'composing',
                ],
                'textMessage' => [
                    'text' => $txt,
                ],
            ])->json();
        }
    }
}



*****************************************************
*****************************************************
