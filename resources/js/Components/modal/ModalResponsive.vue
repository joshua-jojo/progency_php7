<template lang="">
    <teleport to='body'>
        <input type="checkbox" :id="id" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="font-bold text-lg">{{title}}</h3>
                <div class="py-4">
                    <slot></slot>
                </div>
                <div class="modal-action">
                    <slot name="action"></slot>
                    <label v-if="close" :for="id" class="btn">Close</label>
                </div>
            </div>
        </div>
    </teleport>
</template>
<script setup>
import { defineProps } from 'vue';

const props = defineProps(['id', 'title', 'close'])
</script>
<style lang="">
    
</style>