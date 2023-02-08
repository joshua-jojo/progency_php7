<template lang="">
    <div class="form-control w-full">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text capitalize">{{title}}</span>
            </label>
            <input :required="required" :type="hidden ? 'password' : 'text'" v-model="data_input" :placeholder="placeholder ? placeholder:('Masukkan ' + title)" class="input input-bordered w-full" :class="type_input" />
            <label class="label" v-if="error">
                <span class="label-text-alt text-error">{{error}}</span>
            </label>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        inputValue: String,
        error: String,
        placeholder: String,
        hidden: Boolean,
        required: Boolean,
        xs: Boolean,
        sm: Boolean,
        lg: Boolean,
    },
    data() {
        return {
            data_input: this.inputValue,
            type_input: {
                'input-xs': this.xs,
                'input-lg': this.lg,
                'input-sm': this.sm,
            }
        }
    },
    watch: {
        data_input(baru) {
            this.$emit('update:inputValue', baru)
        }
    }
}
</script>
<style lang="">
    
</style>