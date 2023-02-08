<template lang="">
    <Card class="flex flex-col pb-10 gap-8">
                <div class="font-black text-3xl uppercase text-center">
                    Developer
                    <div class="label-text-alt">{{developer.status_terverifikasi}}</div>
                </div>
                <div class="h-[9rem] flex justify-center">
                    <img
                    class=" object-cover h-full mask mask-squircle"
                    :src="(developer.logo? developer.logo : foto_profil)"
                />
                </div>
                <div class="flex flex-col">
                    <div class="capitalize text-center text-xl font-bold drop-shadow-lg">
                        {{developer.user.nama}}
                    </div>
                </div>
            </Card>
</template>
<script setup>
import Card from '../../../Components/card/card.vue';
import { defineProps } from 'vue';

const props = defineProps({
    developer: Object,
    foto_profil: String,
})
</script>
<style lang="">
    
</style>