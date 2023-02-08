<template lang="">
            <Card class="flex flex-col pb-10 gap-8">
                <div class="font-black text-3xl uppercase text-center">
                        Agen
                <div class="text-center text-xs font-normal">{{dataAgen.status_terverifikasi}}</div>
                </div>
                <div class="h-[9rem] flex justify-center">
                    <img
                    class=" object-cover h-full mask mask-squircle"
                    :src="(dataAgen.foto? dataAgen.foto : foto_profil)"
                />
                </div>
                <div class="flex flex-col">
                    <div class="uppercase text-center font-bold italic text-lg" :class="{'text-[#e8b923] drop-shadow-xl' : dataAgen.rating == 'gold' || dataAgen.rating == 'platinum'}">
                        {{dataAgen.rating}}
                    </div>
                    <div class="capitalize text-center text-xl font-bold drop-shadow-lg">
                        {{dataAgen.user.nama}}
                    </div>
                </div>
            </Card>
</template>
<script>
import MainLayout from "../../../Layouts/MainLayout.vue";
import Card from "../../../Components/card/card.vue";

export default {
    layout: MainLayout,
    components: {
        Card,
    },
    props: {
        dataAgen: Object,
        foto_profil: String,
    },
};
</script>
<style lang=""></style>
