<template lang="">
    <div class="form-control w-full" :key="inputValue">
        <label class="label">
            <span class="label-text capitalize">{{title}}</span>
        </label>
        <select class="select select-bordered " :value="inputValue" :disabled="disabled" :class="{'select-sm' : sm ,'select-lg' : lg}" v-model="data_pick">
            <option v-for="(item, index) in dataSelect" :key="item" :value="item[pick]">{{item[label]}}</option>
        </select>
        <label class="label" v-if="error">
            <span class="label-text-alt text-error">{{error}}</span>
        </label>
    </div>
</template>
<script>
export default {
    props: {
        sm: Boolean,
        lg: Boolean,
        disabled: Boolean,
        dataSelect: Array,
        inputValue: String,
        label: String,
        pick: String,
        error: String,
        title: String,
    },
    data() {
        return {
            data_pick: this.inputValue ? this.inputValue : null,
        }
    },
    watch: {
        data_pick(baru) {
            this.$emit('update:inputValue', baru)
        }
    }
}
</script>
<style lang="">
    
</style>