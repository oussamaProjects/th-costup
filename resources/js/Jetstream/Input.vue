<template>
    <input class="appearance-none border-0 border-secondary ring-0 focus:ring-0 bg-main focus:bg-main text-custom_blue bottom-0 border-b shadow-sm" :value="modelValue" 
    @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    })
</script>
