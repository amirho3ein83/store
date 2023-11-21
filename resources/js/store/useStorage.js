import { ref, watch } from "vue";

export function useStorage(key, dval = null) {
    let storedVal = read();

    if (storedVal) {
        dval = ref(storedVal);
    } else {
        dval = ref(dval);
        write();
    }

    watch(dval, write);

    function read() {
        return sessionStorage.getItem(key);
    }

    function write() {
        if (dval.value === "" || dval.value === null) {
            sessionStorage.removeItem(key);
        } else {
            sessionStorage.setItem(key, dval.value);
        }
    }

    return dval;
}
