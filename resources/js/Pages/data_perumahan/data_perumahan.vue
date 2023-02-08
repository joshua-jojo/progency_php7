<template lang="">
    <div class="flex flex-col gap-6 justify-center w-full">
        <div class="form-control gap-2 mt-4 w-full flex flex-col justify-center items-center">
            <div class="input-group w-full max-w-lg">
                <input type="text" v-model="cari" placeholder="Search…" class="input input-md w-full input-bordered" />
                <button class="btn btn-square btn-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
            <div class="flex justify-center">
                <label for="filter" class="btn btn-sm gap-2">filter <i class="fa fa-gear"></i></label>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 px-4 py-7 overflow-auto">
            <card2 v-for="item in perumahan.data" :key="item.id" v-if="perumahan.total">
                <a class="block relative h-[10rem] lg:h-48 overflow-hidden rounded-lg">
                    <img alt="ecommerce" class="object-contain object-center rounded-lg w-full h-full block" :src="item.cover">
                </a>
                <div class="flex flex-col mt-2">
                    <h2 class="title-font text-2xl font-bold text-blue-800 drop-shadow-sm">{{rupiah(item.harga)}}</h2>
                    <p class=" font-semibold text-lg">{{item.nama}}{{` - Tipe ${item.tipe}`}}</p>
                    <div class="text-xs">{{item.alamat}}</div>
                    <div class="text-sm font-bold uppercase">{{item.jenis}}</div>
                    <div class="my-2 border-t-2"></div>
                    <table class="w-max text-sm mb-2">
                        <tbody>
                            <tr>
                                <td>LT : {{item.perumahan_detail.luas_tanah}}m<sup>2</sup></td>
                                <td class="pl-2">LB : {{item.perumahan_detail.luas_bangunan}}m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-bed"></i> : {{item.perumahan_detail.kamar_tidur}}</td>
                                <td class="pl-2"><i class="fa-solid fa-bath"></i> : {{item.perumahan_detail.kamar_mandi}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="grid gap-2 lg:grid-cols-2">
                        <a :href="route('map.perumahan.show',{perumahan : item.id})" target="_blank" class="btn btn-sm btn-primary">Lihat Maps</a>
                        <Link :href="route('daftar.perumahan.show',{perumahan : item.id})" class="btn btn-sm">Detail</Link>
                    </div>
                </div>
            </card2>
            <div class="text-center w-full col-span-1 capitalize text-lg font-semibold lg:col-span-4" v-else>
                perumahan tidak tersedia!
            </div>
        </div>
        <div class="flex justify-center" v-if="perumahan.total">
            <div class="btn-group">
                <Link as="button" :disabled="!item.url"  :class="{'btn-active' : item.active}" :href="item.url" class="btn btn-sm" v-for="item in perumahan.links" :key="item" v-html="item.label"></Link>
            </div>
        </div>
    </div>
    <modal-responsive id="filter" class="select-none" close="true" title="Filter Pencarian">

        <div class="capitalize font-bold text-md">urutkan</div>
        <div class="flex gap-2 my-3">
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : urutkan=='apapun'}" @click="urutkan='apapun'">Apapun</div>
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : urutkan=='terbaru'}" @click="urutkan='terbaru'">Terbaru</div>
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : urutkan=='harga tertinggi'}" @click="urutkan='harga tertinggi'">Harga tertinggi</div>
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : urutkan=='harga terendah'}" @click="urutkan='harga terendah'">Harga terendah</div>
        </div>

        <div class="capitalize font-bold text-md">kondisi</div>
        <div class="flex gap-2 my-3">
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : kondisi=='apapun'}" @click="kondisi='apapun'">Apapun</div>
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : kondisi=='baru'}" @click="kondisi='baru'">Baru</div>
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : kondisi=='bekas'}" @click="kondisi='bekas'">Bekas</div>
        </div>

        <div class="capitalize font-bold text-md">harga</div>
        <div class="grid grid-cols-12 gap-2 my-3 items-center">
            <div class="form-control col-span-5 w-full">
            <div class="label-text-alt mb-1">{{rupiah(harga.min)}}</div>
                <label class="input-group input-group-sm w-full">
                    <span>Rp.</span>
                    <input type="number" v-model="harga.min" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
            <div class="flex justify-center items-center">
                <i class="fa-solid fa-arrow-right w-max col-span-2"></i>
            </div>
            <div class="form-control col-span-5 w-full">
            <div class="label-text-alt mb-1">{{rupiah(harga.max)}}</div>
                <label class="input-group input-group-sm w-full">
                    <span>Rp.</span>
                    <input type="number" v-model="harga.max" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
        </div>

        <div class="capitalize font-bold text-md">Luas Tanah</div>
        <div class="grid grid-cols-12 gap-2 my-3 items-center">
            <div class="form-control col-span-5 w-full">
                <label class="input-group input-group-sm w-full">
                    <span class="ordinal">M<sup>2</sup></span>
                    <input type="number" v-model="luas_tanah.min" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
            <div class="flex justify-center items-center">
                <i class="fa-solid fa-arrow-right w-max col-span-2"></i>
            </div>
            <div class="form-control col-span-5 w-full">
                <label class="input-group input-group-sm w-full">
                    <span class="ordinal">M<sup>2</sup></span>
                    <input type="number" v-model="luas_tanah.max" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
        </div>

        <div class="capitalize font-bold text-md">Luas Bangunan</div>
        <div class="grid grid-cols-12 gap-2 my-3 items-center">
            <div class="form-control col-span-5 w-full">
                <label class="input-group input-group-sm w-full">
                    <span class="ordinal">M<sup>2</sup></span>
                    <input type="number" v-model="luas_bangunan.min" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
            <div class="flex justify-center items-center">
                <i class="fa-solid fa-arrow-right w-max col-span-2"></i>
            </div>
            <div class="form-control col-span-5 w-full">
                <label class="input-group input-group-sm w-full">
                    <span class="ordinal">M<sup>2</sup></span>
                    <input type="number" v-model="luas_bangunan.max" placeholder="Type here" class="input input-bordered input-sm w-full" />
                </label>
            </div>
        </div>

        <div class="capitalize font-bold text-md">Kamar Tidur</div>
        <div class="flex gap-2 my-3">
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : kamar_tidur==item}" @click="kamar_tidur=item" v-for="item in 4">>{{item}} Kamar</div>
        </div>

        <div class="capitalize font-bold text-md">Kamar Mandi</div>
        <div class="flex gap-2 my-3">
            <div class="btn btn-outline btn-primary w-max btn-xs" :class="{'btn-active' : kamar_mandi==item}" @click="kamar_mandi=item" v-for="item in 4">>{{item}} Kamar</div>
        </div>
    </modal-responsive>
</template>
<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import InputText from '../../Components/input/InputText.vue';
import ModalResponsive from '../../Components/modal/ModalResponsive.vue';
import card2 from '../../Components/card/card2.vue';
import { Link, router } from '@inertiajs/inertia-vue3';
export default {
    layout: MainLayout,
    components: {
        InputText,
        ModalResponsive,
        card2,
        Link,
    },
    props: {
        perumahan: Object,
        search: Object,
    },
    watch: {
        urutkan() {
            this.refreshPage()
        },
        cari() {
            this.refreshPage()
        },
        kondisi() {
            this.refreshPage()
        },
        kamar_tidur() {
            this.refreshPage()
        },
        kamar_mandi() {
            this.refreshPage()
        },
        "harga.min"(baru) {
            if (baru == '') {
                this.harga.min = 0
            }
            this.refreshPage()
        },
        "harga.max"(baru) {
            if (baru == '') {
                this.harga.max = 0
            }
            this.refreshPage()
        },
        "luas_tanah.min"(baru) {
            if (baru == '') {
                this.luas_tanah.min = 0
            }
            this.refreshPage()
        },
        "luas_tanah.max"(baru) {
            if (baru == '') {
                this.luas_tanah.max = 0
            }
            this.refreshPage()
        },
        "luas_bangunan.min"(baru) {
            if (baru == '') {
                this.luas_bangunan.min = 0
            }
            this.refreshPage()
        },
        "luas_bangunan.max"(baru) {
            if (baru == '') {
                this.luas_bangunan.max = 0
            }
            this.refreshPage()
        },
    },
    data() {
        return {
            cari: this.search.cari,
            urutkan: this.search.urutkan,
            kondisi: this.search.kondisi,
            kamar_tidur: this.search.kamar_tidur,
            kamar_mandi: this.search.kamar_mandi,
            harga: {
                min: this.search.harga.min,
                max: this.search.harga.max,
            },
            luas_tanah: {
                min: this.search.luas_tanah.min,
                max: this.search.luas_tanah.max,
            },
            luas_bangunan: {
                min: this.search.luas_bangunan.min,
                max: this.search.luas_bangunan.max,
            },
        }
    },
    methods: {
        refreshPage() {
            this.$inertia.get(route('daftar.perumahan.index'), {
                cari: this.cari,
                urutkan: this.urutkan,
                kondisi: this.kondisi,
                kamar_tidur: this.kamar_tidur,
                kamar_mandi: this.kamar_mandi,
                harga: this.harga,
                luas_tanah: this.luas_tanah,
                luas_bangunan: this.luas_bangunan,
            }, {
                only: ['perumahan'],
                preserveState: true
            })
        }
    }
}
</script>
<style lang="">
    
</style>