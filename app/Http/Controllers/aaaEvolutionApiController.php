<?php
//. IDEIXA PARA UTILIZAR O API GATEWAY NO WEB PANEL
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\CompanyParam;
use App\Models\Message;
use App\Models\ServiceWa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OldController extends Controller
{
    private string $apiGatewayBase;

    public function __construct()
    {
        $this->middleware('auth');
        $this->apiGatewayBase = config('services.api_gateway.url'); // URL da API Gateway
    }

    // Pega dados da empresa e inicializa configurações do bot
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

    // Define o tipo do bot (IA ou MSG)
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

    // Habilita ou desabilita bot global
    public function hab(Request $request)
    {
        $companyParam = CompanyParam::query()->first();
        $companyParam->enable_bot = (int) $request->hab;
        $companyParam->save();

        return response()->json([], 200);
    }

    // Habilita ou desabilita bot individual
    public function habAttendance(Request $request)
    {
        $attendance = Attendance::query()->where('id', $request->id)->first();
        $attendance->enable_bot = (int) $request->hab;
        $attendance->save();

        return response()->json([], 200);
    }

    // Lista atendimentos
    public function attendanceList()
    {
        $attendances = Attendance::query()->orderBy('last_message_at', 'desc')->get();

        return response()->json($attendances, 200);
    }

    // Detalhes de atendimento específico
    public function attendanceUnic($phone)
    {
        $attendance = Attendance::query()->where('phone', $phone)->first();
        $messages = Message::query()->where('attendance_id', $attendance->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'attendance' => $attendance,
            'messages' => $messages,
        ], 200);
    }

    // Webhook que processa mensagens recebidas
    public function webhook(Request $request)
    {
        event(new \App\Events\WebHookWhatsapp($request->all(), 'whatsapp'));
        $this->checkSendFirstMessage($request);

        return 'OK';
    }

    // Lógica para enviar primeira mensagem via API Gateway
    public function checkSendFirstMessage(Request $request)
    {
        if ($request->event != 'messages.upsert') return 'nothing';

        $data = $request->all()['data'] ?? [];
        $phone = $data['key']['remoteJid'] ?? '';
        $name = $data['pushName'] ?? '';
        $msg = $data['messageType'] ?? '';

        if ($msg === 'extendedTextMessage') {
            $msg = $data['message']['extendedTextMessage']['text'] ?? '';
        } elseif ($msg === 'conversation') {
            $msg = $data['message']['conversation'] ?? '';
        }

        $fromMe = $data['key']['fromMe'] ?? false;
        $group = isset($data['key']['participant']);

        if ($phone === 'status@broadcast' || $fromMe || $group) return 'nothing';

        $company = Company::query()->first();
        if (!$company) return 'Não encontrou empresa';

        $serviceWa = ServiceWa::where('phone', $phone)->orderBy('created_at', 'desc')->first();
        $today = Carbon::now()->format('Y-m-d');
        $last = $serviceWa ? Carbon::parse($serviceWa->created_at)->format('Y-m-d') : null;

        if (!$serviceWa || $last < $today) {
            return $this->sentFirstMessage($phone, $msg, $name, $company);
        }

        return 'nothing';
    }

    // Envia primeira mensagem via API Gateway e registra serviço
    public function sentFirstMessage($phone, $msg, $name, $company)
    {
        if (!$company->first_message_whatsapp) return 'mensagem não preenchida';

        $response = Http::post("{$this->apiGatewayBase}/messages/send", [
            'phone' => $phone,
            'message' => $company->first_message_whatsapp,
        ]);

        ServiceWa::where('phone', $phone)->delete();
        ServiceWa::create([
            'phone' => $phone,
            'msg' => $msg,
            'name' => $name,
        ]);

        return $response->json();
    }
}
