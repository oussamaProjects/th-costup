<template>
    <button :type="type" class="inline-flex items-center justify-center px-4 py-2 bg-error border border-transparent rounded-md font-semibold text-xs text-custom_blue uppercase tracking-widest hover:bg-error focus:outline-none focus:border-error focus:ring focus:ring-error active:bg-error disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    })
</script>
