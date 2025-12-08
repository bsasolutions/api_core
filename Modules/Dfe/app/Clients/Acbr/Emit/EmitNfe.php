<?php

namespace Modules\Dfe\app\Clients\Acbr\Emit;

use Modules\Dfe\app\Clients\Acbr\NfeClient;

class EmitNfe
{
    public function execute(NfeClient $client, array $payload): array
    {
        $payload = $this->ExampleAcbr();

        $data = $this->transformToAcbr($payload);

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
                'dest' => [
                    'CPF' => '22222222222',
                    'xNome' => 'CLIENTE TESTE',
                    'enderDest' => [
                        'xLgr' => 'Rua B',
                        'nro' => '200',
                        'xBairro' => 'Centro',
                        'cMun' => '3550308',
                        'xMun' => 'São Paulo',
                        'UF' => 'SP',
                        'CEP' => '01002000',
                        'cPais' => '1058',
                        'xPais' => 'Brasil',
                        'fone' => '11999998888',
                    ],
                    'indIEDest' => 9,
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
                            'IBS' => [
                                'IBS00' => [
                                    'CST' => '00',
                                    'vBC' => 100.00,
                                    'pIBS' => 1.00,
                                    'vIBS' => 1.00,
                                ],
                            ],
                            'CBS' => [
                                'CBS00' => [
                                    'CST' => '00',
                                    'vBC' => 100.00,
                                    'pCBS' => 2.00,
                                    'vCBS' => 2.00,
                                ],
                            ],
                            'IS' => [
                                'IS00' => [
                                    'CST' => '00',
                                    'vBC' => 100.00,
                                    'pIS' => 0.50,
                                    'vIS' => 0.50,
                                ],
                            ],
                        ],
                    ],
                ],
                'total' => [
                    'ICMSTot' => [
                        'vBC' => 100.00,
                        'vICMS' => 18.00,
                        'vProd' => 100.00,
                        'vNF' => 100.00,
                        'vPIS' => 1.65,
                        'vCOFINS' => 7.60,
                        'vTotTrib' => 0,
                        'vDesc' => 0,
                        'vOutro' => 0,
                        'vSeg' => 0,
                        'vFrete' => 0,
                    ],
                ],
            ],
        ];
    }
}
