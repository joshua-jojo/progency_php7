<template lang="">
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text capitalize">{{ title }}</span>
        </label>
        <input
            type="date"
            v-model="data_input"
            class="input input-bordered w-full"
            :class="type_input"
            :required="required"
        />
        <label class="label" v-if="error">
            <span class="label-text-alt text-error">{{ error }}</span>
        </label>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        inputValue: String,
        error: String,
        required: Boolean,
        xs: Boolean,
        sm: Boolean,
        lg: Boolean,
    },
    data() {
        return {
            data_input: this.inputValue,
            type_input: {
                "input-xs": this.xs,
                "input-lg": this.lg,
                "input-sm": this.sm,
            },
        };
    },
    watch: {
        data_input(baru) {
            this.$emit("update:inputValue", baru);
        },
    },
};
</script>
<style lang=""></style>
