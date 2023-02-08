<template lang="">
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text" v-if="fileName">{{title}} : {{fileName}}</span>
            <span class="label-text" v-else>{{title}}</span>
        </label>
        <input type="file" :accept="type" @input="inputValue = $event.target.files[0]" class="file-input file-input-bordered w-full" />
        <label class="label">
            <span class="label-text-alt text-error" v-if="form.errors[dataIndex]">{{form.errors[dataIndex]}}</span>
        </label>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    props: {
        form: Object,
        dataLabel: String,
        dataIndex: String,
        title: String,
        fileName: String,
        type: String,
    },
    components: {
        Link
    },
    data() {
        return {
            inputValue: null,
            formFile: this.form,
        }
    },
    watch: {
        async inputValue(baru) {
            this.formFile[this.dataIndex] = baru
            this.$emit('update:form', this.formFile)
        }
    }
}
</script>
<style lang="">
    
</style>