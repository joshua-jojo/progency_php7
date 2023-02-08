<template lang="">
    <div class="flex justify-center items-center h-screen">
        <div class="w-11/12 lg:w-max">
            <Card title="Jawablah pertanyaan berikut ini">
                <div class="grid lg:grid-cols-2 gap-2">
                    <div class="flex flex-col" v-for="item,index in form.data_jawaban">
                    <div class="">{{item.pertanyaan}}</div>
                    <textarea class="textarea textarea-bordered" v-model="form.data_jawaban[index].jawaban"></textarea>   
                </div>
                </div>
                    <template v-slot:action>
                        <label for="konfirmasi" class="btn btn-success">submit</label>
                    </template>
            </Card>
        </div>
    </div>
    <ModalMd id="konfirmasi" title="Konfirmasi Jawaban" close>
    Tekan Submit jika anda sudah yakin dengan jawaban anda.
        <template v-slot:action>
            <button-submit :form="form" @click="submit" type="success">Submit</button-submit>
        </template>
    </ModalMd>
</template>
<script setup>
import Card from '../Components/card/card2.vue'
import ButtonSubmit from '../Components/button/ButtonSubmit.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import ModalMd from '../Components/modal/ModalMd.vue';


const props = defineProps(['pertanyaan'])
const form = useForm({
    data_jawaban: props.pertanyaan
})

function submit() {
    form.post(route('pertanyaan.agen.store'))
}
</script>
<style lang="">
    
</style>