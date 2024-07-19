 export function isNullOrUndef(value) {
    return value === null || typeof value === 'undefined';
}

export function isValidElement(value) {
     return !(value === null || typeof value === 'undefined');
 }