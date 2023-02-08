<template lang="">
    <div class="form-control">
        <label class="label">
            <span class="label-text">{{title}}</span>
        </label> 
        <textarea :disabled="disabled" class="textarea textarea-bordered h-24" :value="modelValue" @input="emit('update:modelValue',$event.target.value)"></textarea>
        <label class="label">
            <span class="label-text-alt text-error" v-if="form ? form.errors[error] : false">{{form.errors[error]}}</span>
        </label> 
    </div>
</template>
<script setup>
import { defineProps, defineEmits } from 'vue';
const props = defineProps(['title', 'modelValue', 'form', 'error', 'disabled'])
const emit = defineEmits(['update:modelValue'])
</script>
<style lang="">
    
</style>