/**
 * Aplicação automática de formatação em elementos estáticos
 * 
 * Uso no HTML:
 * <span data-format="cpf">12345678900</span>
 * <span data-format="cnpj">12345678900123</span>
 * <span data-format="cpf-cnpj">12345678900</span>
 * <span data-format="cep">12345678</span>
 * <span data-format="phone">11987654321</span>
 * <span data-format="currency">1234.56</span>
 */

import {
    cpfMask,
    cnpjMask,
    cpfCnpjMask,
    cepMask,
    phoneMask,
    formatCurrency
} from './masks/index.js';

export function initFormats() {
    // CPF
    document.querySelectorAll('[data-format="cpf"]').forEach(element => {
        element.textContent = cpfMask(element.textContent);
    });
    
    // CNPJ
    document.querySelectorAll('[data-format="cnpj"]').forEach(element => {
        element.textContent = cnpjMask(element.textContent);
    });
    
    // CPF/CNPJ Dinâmico
    document.querySelectorAll('[data-format="cpf-cnpj"]').forEach(element => {
        element.textContent = cpfCnpjMask(element.textContent);
    });
    
    // CEP
    document.querySelectorAll('[data-format="cep"]').forEach(element => {
        element.textContent = cepMask(element.textContent);
    });
    
    // Telefone
    document.querySelectorAll('[data-format="phone"]').forEach(element => {
        element.textContent = phoneMask(element.textContent);
    });
    
    // Moeda/Currency
    document.querySelectorAll('[data-format="currency"]').forEach(element => {
        const value = parseFloat(element.textContent) || 0;
        element.textContent = formatCurrency(value);
    });
}

// Inicializa as formatações quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initFormats);
} else {
    initFormats();
}

// Observer para elementos adicionados dinamicamente
if (typeof MutationObserver !== 'undefined') {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.nodeType === 1) { // Element node
                    // Verifica se o próprio nó tem data-format
                    if (node.hasAttribute && node.hasAttribute('data-format')) {
                        applyFormatToElement(node);
                    }
                    
                    // Verifica filhos
                    if (node.querySelectorAll) {
                        const formattedElements = node.querySelectorAll('[data-format]');
                        formattedElements.forEach(el => applyFormatToElement(el));
                    }
                }
            });
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
}

// Função auxiliar para aplicar formato em um elemento específico
function applyFormatToElement(element) {
    const formatType = element.getAttribute('data-format');
    const value = element.textContent;
    
    switch(formatType) {
        case 'cpf':
            element.textContent = cpfMask(value);
            break;
        case 'cnpj':
            element.textContent = cnpjMask(value);
            break;
        case 'cpf-cnpj':
            element.textContent = cpfCnpjMask(value);
            break;
        case 'cep':
            element.textContent = cepMask(value);
            break;
        case 'phone':
            element.textContent = phoneMask(value);
            break;
        case 'currency':
            const numValue = parseFloat(value) || 0;
            element.textContent = formatCurrency(numValue);
            break;
    }
}

// Disponibiliza globalmente
window.applyFormatToElement = applyFormatToElement;
window.initFormats = initFormats;

export default initFormats;

