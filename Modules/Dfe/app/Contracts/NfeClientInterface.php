<?php

namespace Modules\Dfe\app\Contracts;

interface NfeClientInterface
{
    public function handle(string $action, array $payload): array;

    public function emit(array $data): array;      //Emit NF-e
    public function consult(array $data): array;   //General consult by type_document (nfe|cce|cancel|event|inutilize)
    public function cancel(array $data): array;    //Cancel NF-e
    public function cce(array $data): array;       //Carta de correção
    public function inutilize(array $data): array; //Inutilize range

    public function getXml(array $data): array;    //Download XML by type_document
    public function getPdf(array $data): array;    //Download PDF by type_document
}
