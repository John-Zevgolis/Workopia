<template>
    <Transition name="fade">
        <div
            v-if="show"
            class="p-4 text-white rounded fixed right-3 bottom-3"
            :class="{
                'bg-green-500': type === 'success',
                'bg-red-500': type === 'error',
            }"
        >
            <slot />
        </div>
    </Transition>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";

defineProps({
    type: String,
});

let timeout = null;
const show = ref(true);

onMounted(() => {
    timeout = setTimeout(() => (show.value = false), 5000);
});

onUnmounted(() => {
    if (timeout) clearTimeout(timeout);
});
</script>

<style scoped>
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-leave-to {
    opacity: 0;
}
</style>
