<template lang="">
    <div>
        <card2 title="Data Perumahan">
            <div class="my-2 max-w-xs">
                <input-text sm v-model:inputValue="form.cari" title="pencarian"></input-text>
            </div>
            <table class="w-full table table-compact">
                <thead>
                    <tr>
                        <td>no</td>
                        <td>nama</td>
                        <td>developer</td>
                        <td>status</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in perumahan.data" :key="item.id">
                        <td>{{index + 1}}</td>
                        <td>{{item.nama}}</td>
                        <td>{{item.developer.user.nama}}</td>
                        <td>{{item.status}}</td>
                        <td class="gap-2 flex">
                            <a :href="route('daftar.perumahan.show',{perumahan : item.id})" target="_blank" class="btn btn-xs"> <i class="fa fa-eye"></i></a>
                            <a :href="route('pengaturan.developer.show',{developer : item.developer.user.id})" target="_blank" class="btn btn-xs btn-primary"> <i class="fa fa-home"></i></a>
                            <button class="btn btn-xs btn-error"> <i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="my-4 flex justify-center">
                <div class="btn-group">
                    <Link as="button" :class="{'btn-active' : item.active}" :preserveStates="true" :href="item.url" :preserveScroll="true" class="btn btn-sm" v-for="(item, index) in perumahan.links" :key="index" v-html="item.label"></Link>
                </div>
            </div>
        </card2>
    </div>
</template>
<script>
import MainLayout from '../../../Layouts/MainLayout.vue';
import card2 from '../../../Components/card/card2.vue';
import InputText from '../../../Components/input/InputText.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
export default {
    layout: MainLayout,
    components: {
        card2,
        InputText,
        Link,
    },
    props: {
        perumahan: Object,
        cari: String
    },
    setup(props) {
        const form = useForm({
            cari: props.cari,
        })
        return {
            form
        }
    },
    watch: {
        'form.cari'() {
            this.form.get(route('menu.data.superadmin.perumahan.index'), {
                preserveState: true,
                preserveScroll: true,
                only: ['perumahan'],
            })
        }
    },
    mounted() {
        // console.log(this.perumahan);
    }
}
</script>
<style lang="">
    
</style>