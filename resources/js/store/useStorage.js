import { ref, watch } from "vue";

export function useStorage(key) {
    let storedVal = read();

    let val = ref(storedVal);

    watch(val, write);

    function read() {
        return localStorage.getItem(key);
    }

    function write() {
        if (val.value === "" || val.value === null) {
            localStorage.removeItem(key);
        } else {
            console.log(key);
            localStorage.setItem(key, val.value);
        }
    }

    return val;
}
