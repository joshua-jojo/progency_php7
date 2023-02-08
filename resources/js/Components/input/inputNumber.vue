<template lang="">
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text" v-html="title"></span>
        </label>
        <input type="number" min="0" :value="modelValue" @input="emit('update:modelValue',$event.target.value)" class="input input-bordered w-full" />
        <label class="label">
            <span class="label-text-alt text-error" v-if="form ? form.errors[error] : false">{{form.errors[error]}}</span>
        </label>
    </div>
</template>
<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps(['title', 'modelValue', 'form', 'error']);
const emit = defineEmits(['update:modelValue'])
</script>
<style lang="">
    
</style>