<?php

namespace Modules\Dfe\app\Clients\Acbr\Emit;

use Modules\Dfe\app\Clients\Acbr\NfeClient;
use App\Exceptions\ApiException;

class EmitNfe
{
    public function execute(NfeClient $client, array $payload): array
    {
        $payload = $this->ExampleAcbr();

        $data = $this->transformToAcbr($payload);
        //throw new ApiException(['dfe.nfe.debug'], 400, ['data' => $data]);
        return $client->request('post', '/nfe', $data);
    }

    private function transformToAcbr(array $payload): array
    {
        //! Exmple: Include custom field and delete the original.
        $payload['infNFe']['versao'] = $payload['infNFe']['version'] ?? null;
        unset($payload['infNFe']['version']);
        return $payload;
    }

    private function ExampleAcbr(): array
    {
        return [
            'infNFe' => [
                'versao' => '4.00',
                'Id' => 'NFe35191111111111111111550010000000011000000010',
                'ide' => [
                    'cUF' => 35,
                    'cNF' => '00000001',
                    'natOp' => 'VENDA',
                    'mod' => 55,
                    'serie' => 1,
                    'nNF' => 1,
                    'dhEmi' => '2025-01-10T10:00:00-03:00',
                    'tpNF' => 1,
                    'idDest' => 1,
                    'cMunFG' => '3550308',
                    'tpImp' => 1,
                    'tpEmis' => 1,
                    'cDV' => 1,
                    'tpAmb' => 2,
                    'finNFe' => 1,
                    'indFinal' => 1,
                    'indPres' => 1,
                    'procEmi' => 0,
                    'verProc' => '1.0.0',
                ],
                'emit' => [
                    'CNPJ' => '11111111000191',
                    'xNome' => 'EMPRESA TESTE LTDA',
                    'xFant' => 'EMPRESA TESTE',
                    'enderEmit' => [
                        'xLgr' => 'Rua A',
                        'nro' => '100',
                        'xBairro' => 'Centro',
                        'cMun' => '3550308',
                        'xMun' => 'São Paulo',
                        'UF' => 'SP',
                        'CEP' => '01001000',
                        'cPais' => '1058',
                        'xPais' => 'Brasil',
                        'fone' => '1133334444',
                    ],
                    'IE' => '111111111111',
                    'CRT' => 3,
                ],
                'det' => [
                    [
                        'nItem' => 1,
                        'prod' => [
                            'cProd' => '001',
                            'cEAN' => 'SEM GTIN',
                            'xProd' => 'Produto Exemplo',
                            'NCM' => '61091000',
                            'CFOP' => '5102',
                            'uCom' => 'UN',
                            'qCom' => 1,
                            'vUnCom' => 100.00,
                            'vProd' => 100.00,
                            'cEANTrib' => 'SEM GTIN',
                            'uTrib' => 'UN',
                            'qTrib' => 1,
                            'vUnTrib' => 100.00,
                            'indTot' => 1,
                        ],

                        'imposto' => [
                            'ICMS' => [
                                'ICMS00' => [
                                    'orig' => 0,
                                    'CST' => '00',
                                    'modBC' => 3,
                                    'vBC' => 100.00,
                                    'pICMS' => 18.00,
                                    'vICMS' => 18.00,
                                ],
                            ],

                            'PIS' => [
                                'PISAliq' => [
                                    'CST' => '01',
                                    'vBC' => 100.00,
                                    'pPIS' => 1.65,
                                    'vPIS' => 1.65,
                                ],
                            ],

                            'COFINS' => [
                                'COFINSAliq' => [
                                    'CST' => '01',
                                    'vBC' => 100.00,
                                    'pCOFINS' => 7.60,
                                    'vCOFINS' => 7.60,
                                ],
                            ],

                            'IS' => [
                                'CSTIS' => '01',
                                'cClassTribIS' => '010101',
                                'vBCIS' => 0.00,
                                'pIS' => 0.00,
                                'pISEspec' => 0,
                                'uTrib' => 'UN',
                                'qTrib' => 1,
                                'vIS' => 0.00,
                            ],

                            'IBSCBS' => [
                                'CST' => '01',
                                'cClassTrib' => '010101',
                                'indDoacao' => 0,

                                'gIBSCBS' => [
                                    'vBC' => 100.00,

                                    'gIBSUF' => [
                                        'pIBSUF' => 1.00,
                                        'gDif' => ['pDif' => 0, 'vDif' => 0],
                                        'gDevTrib' => ['vDevTrib' => 0],
                                        'gRed' => ['pRedAliq' => 0, 'pAliqEfet' => 1.00],
                                        'vIBSUF' => 1.00,
                                    ],

                                    'gIBSMun' => [
                                        'pIBSMun' => 0.50,
                                        'gDif' => ['pDif' => 0, 'vDif' => 0],
                                        'gDevTrib' => ['vDevTrib' => 0],
                                        'gRed' => ['pRedAliq' => 0, 'pAliqEfet' => 0.50],
                                        'vIBSMun' => 0.50,
                                    ],

                                    'vIBS' => 1.50,

                                    'gCBS' => [
                                        'pCBS' => 2.00,
                                        'gDif' => ['pDif' => 0, 'vDif' => 0],
                                        'gDevTrib' => ['vDevTrib' => 0],
                                        'gRed' => ['pRedAliq' => 0, 'pAliqEfet' => 2.00],
                                        'vCBS' => 2.00,
                                    ],
                                ],
                            ],

                        ],
                    ],
                ],
                'total' => [
                    'ICMSTot' => [
                        'vBC' => 100.00,
                        'vICMS' => 18.00,
                        'vICMSDeson' => 0,
                        'vFCPUFDest' => 0,
                        'vICMSUFDest' => 0,
                        'vICMSUFRemet' => 0,
                        'vFCP' => 0,
                        'vBCST' => 0,
                        'vST' => 0,
                        'vFCPST' => 0,
                        'vFCPSTRet' => 0,
                        'qBCMono' => 0,
                        'vICMSMono' => 0,
                        'qBCMonoReten' => 0,
                        'vICMSMonoReten' => 0,
                        'qBCMonoRet' => 0,
                        'vICMSMonoRet' => 0,
                        'vProd' => 100.00,
                        'vFrete' => 0,
                        'vSeg' => 0,
                        'vDesc' => 0,
                        'vII' => 0,
                        'vIPI' => 0,
                        'vIPIDevol' => 0,
                        'vPIS' => 1.65,
                        'vCOFINS' => 7.60,
                        'vOutro' => 0,
                        'vNF' => 100.00,
                        'vTotTrib' => 0,
                    ],

                    'ISTot' => [
                        'vIS' => 0.50,
                    ],

                    'IBSCBSTot' => [
                        'vBCIBSCBS' => 100.00,

                        'gIBS' => [
                            'gIBSUF' => [
                                'vDif' => 0,
                                'vDevTrib' => 0,
                                'vIBSUF' => 0,
                            ],
                            'gIBSMun' => [
                                'vDif' => 0,
                                'vDevTrib' => 0,
                                'vIBSMun' => 0,
                            ],
                            'vIBS' => 1.00,
                            'vCredPres' => 0,
                            'vCredPresCondSus' => 0,
                        ],

                        'gCBS' => [
                            'vDif' => 0,
                            'vDevTrib' => 0,
                            'vCBS' => 2.00,
                            'vCredPres' => 0,
                            'vCredPresCondSus' => 0,
                        ],

                        'gMono' => [
                            'vIBSMono' => 0,
                            'vCBSMono' => 0,
                            'vIBSMonoReten' => 0,
                            'vCBSMonoReten' => 0,
                            'vIBSMonoRet' => 0,
                            'vCBSMonoRet' => 0,
                        ],

                        'gEstornoCred' => [
                            'vIBSEstCred' => 0,
                            'vCBSEstCred' => 0,
                        ],
                    ],

                    'vNFTot' => 100.00,
                ],

            ],
        ];
    }
}
