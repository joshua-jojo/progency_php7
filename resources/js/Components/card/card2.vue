<template lang="">
    <div class="card w-full bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title" v-if="title">{{title}}</h2>
                <div class="flex flex-col">
                    <slot></slot>
                </div>
            <div class="card-actions justify-end">
                <slot name="action"></slot>
            </div>
        </div>
    </div>
</template>
<script setup>
import { defineProps } from 'vue'

const props = defineProps(['title', 'action'])
</script>
<style lang="">
    
</style>