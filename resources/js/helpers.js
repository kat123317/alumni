import { ref } from "vue";

export default function helpers() {
    const alertOn = ref(false);
    const alertOnUpdate = ref(false);
    const alertOnDelete = ref(false);
    const alertOnError = ref(false);
    const alertOnMessage = ref('');

    const onAlert = (data) => {
        if (data == "Success") {
            alertOn.value = true;
        } else if (data == "Update") {
            alertOnUpdate.value = true;
        } else if (data == "Delete") {
            alertOnDelete.value = true;
        } else {
            alertOnError.value = true;
        }
    
        setTimeout(() => {
            if (data == "Success") {
                alertOn.value = false;
            } else if (data == "Update") {
                alertOnUpdate.value = false;
            } else if (data == "Delete") {
                alertOnDelete.value = false;
            } else {
                alertOnError.value = false;
            }
        }, 4000);
    };

    return {
        alertOn,
        alertOnUpdate,
        alertOnDelete,
        alertOnError,
        alertOnMessage,
        onAlert
    }
}