/**
 * Máscara para Valores Monetários (BRL)
 * Formato: R$ 1.234,56
 */

export function currencyMask(value, options = {}) {
    const {
        prefix = 'R$ ',
        decimals = 2,
        thousands = '.',
        decimal = ',',
        allowNegative = false
    } = options;
    
    if (!value && value !== 0) return prefix + '0' + decimal + '00';
    
    // Remove tudo exceto dígitos e sinal negativo
    let cleanValue = String(value).replace(/[^\d-]/g, '');
    
    // Trata número negativo
    const isNegative = cleanValue.startsWith('-');
    if (!allowNegative && isNegative) {
        cleanValue = cleanValue.substring(1);
    }
    
    // Converte para número
    const numValue = parseInt(cleanValue) || 0;
    
    // Divide por 100 para ter os centavos
    const floatValue = numValue / Math.pow(10, decimals);
    
    // Formata o número
    let formatted = floatValue.toFixed(decimals);
    
    // Separa parte inteira e decimal
    const parts = formatted.split('.');
    let integerPart = parts[0];
    const decimalPart = parts[1];
    
    // Adiciona separador de milhares
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousands);
    
    // Monta o valor final
    formatted = integerPart + decimal + decimalPart;
    
    // Adiciona sinal negativo se necessário
    if (isNegative && allowNegative) {
        formatted = '-' + formatted;
    }
    
    return prefix + formatted;
}

export function applyCurrencyMask(input, options = {}) {
    if (!input) return;
    
    input.addEventListener('input', (e) => {
        const cursorPosition = e.target.selectionStart;
        const oldValue = e.target.value;
        const newValue = currencyMask(e.target.value, options);
        
        e.target.value = newValue;
        
        // Ajusta posição do cursor
        const diff = newValue.length - oldValue.length;
        e.target.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
    });
    
    // Aplica máscara no valor inicial se existir
    if (input.value) {
        input.value = currencyMask(input.value, options);
    }
    
    // Formata ao perder o foco
    input.addEventListener('blur', (e) => {
        e.target.value = currencyMask(e.target.value, options);
    });
}

export function removeCurrencyMask(value) {
    if (!value) return '0';
    
    // Remove tudo exceto dígitos, vírgula e ponto
    const cleanValue = String(value).replace(/[^\d,.-]/g, '');
    
    // Remove separadores de milhares e troca vírgula por ponto
    return cleanValue
        .replace(/\./g, '')
        .replace(',', '.');
}

export function currencyToFloat(value) {
    const cleanValue = removeCurrencyMask(value);
    return parseFloat(cleanValue) || 0;
}

export function currencyToInt(value) {
    const floatValue = currencyToFloat(value);
    return Math.round(floatValue * 100);
}

export function formatCurrency(value, options = {}) {
    const {
        prefix = 'R$ ',
        decimals = 2,
        thousands = '.',
        decimal = ','
    } = options;
    
    const numValue = parseFloat(value) || 0;
    const formatted = numValue.toFixed(decimals);
    const parts = formatted.split('.');
    
    let integerPart = parts[0];
    const decimalPart = parts[1];
    
    // Adiciona separador de milhares
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, thousands);
    
    return prefix + integerPart + decimal + decimalPart;
}

/**
 * Aplica máscara de currency em input type="number"
 * Converte o input para text e aplica a máscara
 */
export function convertNumberToCurrency(input, options = {}) {
    if (!input) return;
    
    // Converte para text se for number
    if (input.type === 'number') {
        const value = input.value;
        input.type = 'text';
        input.value = value;
    }
    
    applyCurrencyMask(input, options);
}

