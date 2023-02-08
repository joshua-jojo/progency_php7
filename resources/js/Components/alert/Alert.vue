<template lang="">
    <div 
        class="alert shadow-lg" 
        :class="{
            'alert-success' : type=='success',
            'alert-info' : type=='info',
            '' : type=='info-light',
            'alert-warning' : type=='warning',
            'alert-error' : type=='error',
            }"
    >
        <div>
            <svg v-if="type == 'success'" xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <svg v-else-if="type == 'info' || type == 'info-light'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <svg v-else-if="type == 'warning'" xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            <svg v-else-if="type == 'error'" xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <div>
                <h3 class="font-bold" v-if="title">{{title}}</h3>
                <span  v-if="text">{{text}}</span>
                <div class="text-xs" v-if="subtitle">{{subtitle}}</div>
            </div>
        </div>
        <div class="flex-none">
            <slot name="action"></slot>
        </div>
    </div>
</template>
<script setup>
import { defineProps } from 'vue'

const props = defineProps(['title', 'subtitle', 'type', 'text'])
</script>
<style lang="">
    
</style>