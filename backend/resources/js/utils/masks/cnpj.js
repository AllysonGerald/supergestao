/**
 * Máscara para CNPJ
 * Formato: 00.000.000/0000-00
 */

export function cnpjMask(value) {
    if (!value) return '';
    
    return value
        .replace(/\D/g, '')
        .replace(/(\d{2})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1/$2')
        .replace(/(\d{4})(\d)/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
}

export function applyCnpjMask(input) {
    if (!input) return;
    
    input.addEventListener('input', (e) => {
        e.target.value = cnpjMask(e.target.value);
    });
    
    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = cnpjMask(input.value);
    }
}

export function removeCnpjMask(value) {
    return value ? value.replace(/\D/g, '') : '';
}

export function isValidCnpj(cnpj) {
    cnpj = removeCnpjMask(cnpj);
    
    if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) {
        return false;
    }
    
    let length = cnpj.length - 2;
    let numbers = cnpj.substring(0, length);
    let digits = cnpj.substring(length);
    let sum = 0;
    let pos = length - 7;
    
    for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
    }
    
    let result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
    if (result !== parseInt(digits.charAt(0))) return false;
    
    length = length + 1;
    numbers = cnpj.substring(0, length);
    sum = 0;
    pos = length - 7;
    
    for (let i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2) pos = 9;
    }
    
    result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
    if (result !== parseInt(digits.charAt(1))) return false;
    
    return true;
}

