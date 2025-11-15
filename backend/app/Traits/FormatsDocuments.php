<?php

namespace App\Traits;

trait FormatsDocuments
{
    /**
     * Formata CPF (000.000.000-00)
     */
    public function formatCpf(string $cpf): string
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        
        if (strlen($cpf) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
        }
        
        return $cpf;
    }

    /**
     * Formata CNPJ (00.000.000/0000-00)
     */
    public function formatCnpj(string $cnpj): string
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);
        
        if (strlen($cnpj) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
        }
        
        return $cnpj;
    }

    /**
     * Formata CEP (00000-000)
     */
    public function formatCep(string $cep): string
    {
        $cep = preg_replace('/\D/', '', $cep);
        
        if (strlen($cep) === 8) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
        }
        
        return $cep;
    }

    /**
     * Remove formatação de documento
     */
    public function removeDocumentFormat(string $document): string
    {
        return preg_replace('/\D/', '', $document);
    }
}

