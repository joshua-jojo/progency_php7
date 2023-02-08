<template lang="">
    <Card class="flex flex-col gap-8" :key="form.processing">
        <form @submit.prevent="submit">
            <div class="flex justify-start flex-col">
                <input-text
                    sm
                    title="NIK"
                    v-model:inputValue="form.nik"
                    :error="form.errors.nik"
                ></input-text>
                <input-text
                    sm
                    title="Nama"
                    v-model:inputValue="form.nama"
                    :error="form.errors.nama"
                ></input-text>
                    <div class="flex">
                        <div class="label">Jenis kelamin :</div>
                        <div class="form-control w-max">
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text order-last">Pria</span>
                                <input
                                    type="radio"
                                    v-model="form.jenis_kelamin"
                                    value="pria"
                                    class="radio radio-primary"
                                />
                            </label>
                        </div>
                        <div class="form-control w-max">
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text order-last"
                                    >Wanita</span
                                >
                                <input
                                    type="radio"
                                    v-model="form.jenis_kelamin"
                                    value="wanita"
                                    class="radio radio-primary"
                                />
                            </label>
                        </div>
                    </div>
                        <div class="label label-text text-error" v-if="form.errors.jenis_kelamin">{{form.errors.jenis_kelamin}}</div>
                <input-text
                    sm
                    title="Telp"
                    v-model:inputValue="form.telp"
                    :error="form.errors.telp"
                ></input-text>
                <div class="grid grid-cols-2 gap-2">
                    <input-text
                        sm
                        title="tempat lahir"
                        :error="form.errors.tempat_lahir"
                        v-model:inputValue="form.tempat_lahir"
                    ></input-text>
                    <input-date
                        sm
                        title="Tanggal Lahir"
                        v-model:inputValue="form.tanggal_lahir"
                        :error="form.errors.tanggal_lahir"
                    ></input-date>
                </div>
                <input-file
                    :form="form"
                    dataIndex="foto"
                    title="Foto Profile"
                    type=".jpg, .png"
                ></input-file>
                <div
                    class="flex gap-2"
                    v-if="
                        $page.props.auth.user.role == 'admin' ||
                        $page.props.auth.user.role == 'super admin'
                    "
                >
                    <div class="label">Status User :</div>
                    <div class="form-control w-max">
                        <label class="label cursor-pointer gap-2">
                            <span class="label-text order-last">Aktif</span>
                            <input
                                type="radio"
                                v-model="form.status_terverifikasi"
                                value="aktif"
                                class="radio radio-primary"
                            />
                        </label>
                    </div>
                    <div class="form-control w-max">
                        <label class="label cursor-pointer gap-2">
                            <span class="label-text order-last"
                                >Tidak Aktif</span
                            >
                            <input
                                type="radio"
                                v-model="form.status_terverifikasi"
                                value="tidak aktif"
                                class="radio radio-primary"
                            />
                        </label>
                    </div>
                </div>
                <div
                    class="flex gap-2"
                    v-if="
                        $page.props.auth.user.role == 'admin' ||
                        $page.props.auth.user.role == 'super admin'
                    "
                >
                    <div class="label">Grade User :</div>
                    <div class="grid w-max grid-cols-2 lg:grid-cols-5">
                        <div
                            class="form-control w-max"
                            v-for="(item, index) in grade"
                            :key="index"
                        >
                            <label class="label cursor-pointer gap-2">
                                <span class="label-text order-last">{{
                                    item
                                }}</span>
                                <input
                                    type="radio"
                                    v-model="form.rating"
                                    :value="item"
                                    class="radio radio-primary"
                                />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button-submit type="success" :form="form"
                    >Simpan</button-submit
                >
            </div>
        </form>
    </Card>
</template>
<script>
import MainLayout from "../../../Layouts/MainLayout.vue";
import Card from "../../../Components/card/card.vue";
import InputText from "../../../Components/input/InputText.vue";
import InputDate from "../../../Components/input/InputDate.vue";
import InputFile from "../../../Components/input/InputFile.vue";
import ButtonSubmit from "../../../Components/button/ButtonSubmit.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: MainLayout,
    components: {
        Card,
        InputText,
        InputDate,
        InputFile,
        ButtonSubmit,
    },
    props: {
        dataAgen: Object,
    },
    setup(props) {
        const form = useForm({
            _method: "put",
            id: props.dataAgen.id,
            nama: props.dataAgen.user.nama,
            nik: props.dataAgen.nik,
            telp: props.dataAgen.telp,
            tempat_lahir: props.dataAgen.tempat_lahir,
            tanggal_lahir: props.dataAgen.tanggal_lahir,
            foto: props.dataAgen.foto,
            jenis_kelamin: props.dataAgen.jenis_kelamin,
            status_terverifikasi: props.dataAgen.status_terverifikasi,
            rating: props.dataAgen.rating,
        });
        return {
            form,
        };
    },
    data() {
        return {
            grade: ["non-grade", "bronze", "silver", "gold", "platinum"],
        };
    },
    methods: {
        submit() {
            this.form.post(
                route("pengaturan.agen.update", {
                    agen: this.form.id,
                })
            );
        },
    },
};
</script>
<style lang=""></style>
