/**
 * Exportação centralizada de todas as máscaras
 * 
 * Uso:
 * import { applyCpfMask, applyCepMask } from '@/utils/masks';
 */

// CPF
export { 
    cpfMask, 
    applyCpfMask, 
    removeCpfMask, 
    isValidCpf 
} from './cpf.js';

// CNPJ
export { 
    cnpjMask, 
    applyCnpjMask, 
    removeCnpjMask, 
    isValidCnpj 
} from './cnpj.js';

// CPF/CNPJ Dinâmico
export { 
    cpfCnpjMask, 
    applyCpfCnpjMask, 
    removeCpfCnpjMask, 
    isValidCpfCnpj,
    getDocumentType
} from './cpfCnpj.js';

// CEP
export { 
    cepMask, 
    applyCepMask, 
    removeCepMask, 
    isValidCep,
    fetchAddressByCep,
    autoFillAddressByCep
} from './cep.js';

// Telefone
export { 
    phoneMask, 
    applyPhoneMask, 
    removePhoneMask, 
    isValidPhone,
    getPhoneType,
    formatPhone,
    extractDDD,
    extractNumber
} from './phone.js';

// Moeda/Dinheiro
export { 
    currencyMask, 
    applyCurrencyMask, 
    removeCurrencyMask,
    currencyToFloat,
    currencyToInt,
    formatCurrency,
    convertNumberToCurrency
} from './currency.js';

