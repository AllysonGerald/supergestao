/**
 * Máscara para CPF
 * Formato: 000.000.000-00
 */

export function cpfMask(value) {
    if (!value) return '';
    
    return value
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
}

export function applyCpfMask(input) {
    if (!input) return;
    
    input.addEventListener('input', (e) => {
        e.target.value = cpfMask(e.target.value);
    });
    
    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = cpfMask(input.value);
    }
}

export function removeCpfMask(value) {
    return value ? value.replace(/\D/g, '') : '';
}

export function isValidCpf(cpf) {
    cpf = removeCpfMask(cpf);
    
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }
    
    let sum = 0;
    let remainder;
    
    for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;
    
    sum = 0;
    for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.substring(10, 11))) return false;
    
    return true;
}

