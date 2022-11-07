<script setup>
import { defineProps, defineEmits, ref, onMounted } from "vue";
const props = defineProps({
    showHideAlert: {
        type: Boolean,
        default:true
    },
    dynamicAlertConfig: {
        type: Object,
        default:{}
    }
})
const cssDefault = 'flex items-center justify-center w-12'
const textCSSDefault = 'font-semibold '
</script>

<template>
    <section>
     
        <div v-if="showHideAlert" class="w-full mt-2 max-w-[100vw] flex-col items-end z-20 fixed flex justify-end pr-10">

            <div  class="flex slide-in-right mt-2 w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div :class="[dynamicAlertConfig.color, cssDefault]">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span :class="[textCSSDefault, dynamicAlertConfig.txtcolor]">{{dynamicAlertConfig.title}}</span>
                        <p class="text-sm text-gray-600 dark:text-gray-200">{{dynamicAlertConfig.desc}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.slide-in-right {
	-webkit-animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
            transform: translateX(1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}
@keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
            transform: translateX(1000px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateX(0);
            transform: translateX(0);
    opacity: 1;
  }
}

</style>