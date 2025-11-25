/**
 * Máscaras para Telefone
 * Telefone Fixo: (00) 0000-0000
 * Celular: (00) 00000-0000
 * Dinâmico: Detecta automaticamente
 */

export function phoneMask(value) {
    if (!value) return '';

    const cleanValue = value.replace(/\D/g, '');

    // Telefone fixo (10 dígitos): (00) 0000-0000
    if (cleanValue.length <= 10) {
        return cleanValue
            .replace(/(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{4})(\d)/, '$1-$2')
            .replace(/(-\d{4})\d+?$/, '$1');
    }

    // Celular (11 dígitos): (00) 00000-0000
    return cleanValue
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d)/, '$1-$2')
        .replace(/(-\d{4})\d+?$/, '$1');
}

export function applyPhoneMask(input) {
    if (!input) return;

    input.addEventListener('input', (e) => {
        e.target.value = phoneMask(e.target.value);
    });

    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = phoneMask(input.value);
    }
}

export function removePhoneMask(value) {
    return value ? value.replace(/\D/g, '') : '';
}

export function isValidPhone(phone) {
    const cleanPhone = removePhoneMask(phone);
    // Aceita telefone fixo (10 dígitos) ou celular (11 dígitos)
    return cleanPhone.length === 10 || cleanPhone.length === 11;
}

export function getPhoneType(phone) {
    const cleanPhone = removePhoneMask(phone);

    if (cleanPhone.length === 10) {
        return 'fixo';
    }

    if (cleanPhone.length === 11) {
        return 'celular';
    }

    return null;
}

/**
 * Formata telefone para exibição
 * @param {string} phone - Telefone para formatar
 * @returns {string} - Telefone formatado
 */
export function formatPhone(phone) {
    return phoneMask(phone);
}

/**
 * Extrai DDD do telefone
 * @param {string} phone - Telefone
 * @returns {string} - DDD (2 dígitos)
 */
export function extractDDD(phone) {
    const cleanPhone = removePhoneMask(phone);
    return cleanPhone.substring(0, 2);
}

/**
 * Extrai número do telefone sem DDD
 * @param {string} phone - Telefone
 * @returns {string} - Número sem DDD
 */
export function extractNumber(phone) {
    const cleanPhone = removePhoneMask(phone);
    return cleanPhone.substring(2);
}

