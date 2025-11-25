/**
 * Máscara dinâmica para CPF ou CNPJ
 * CPF: 000.000.000-00
 * CNPJ: 00.000.000/0000-00
 */

import { cpfMask, isValidCpf } from './cpf.js';
import { cnpjMask, isValidCnpj } from './cnpj.js';

export function cpfCnpjMask(value) {
    if (!value) return '';

    const cleanValue = value.replace(/\D/g, '');

    // Se tem até 11 dígitos, aplica máscara de CPF
    if (cleanValue.length <= 11) {
        return cpfMask(value);
    }

    // Se tem mais de 11 dígitos, aplica máscara de CNPJ
    return cnpjMask(value);
}

export function applyCpfCnpjMask(input) {
    if (!input) return;

    input.addEventListener('input', (e) => {
        e.target.value = cpfCnpjMask(e.target.value);
    });

    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = cpfCnpjMask(input.value);
    }
}

export function removeCpfCnpjMask(value) {
    return value ? value.replace(/\D/g, '') : '';
}

export function isValidCpfCnpj(value) {
    const cleanValue = removeCpfCnpjMask(value);

    if (cleanValue.length === 11) {
        return isValidCpf(value);
    }

    if (cleanValue.length === 14) {
        return isValidCnpj(value);
    }

    return false;
}

export function getDocumentType(value) {
    const cleanValue = removeCpfCnpjMask(value);

    if (cleanValue.length === 11) {
        return 'CPF';
    }

    if (cleanValue.length === 14) {
        return 'CNPJ';
    }

    return null;
}

