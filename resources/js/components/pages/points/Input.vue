<template>
    <div class="wrap-input100 validate-input m-b-20" :class="{'alert-validate': !! error}" :data-validate="error">
        <input class="input100" :value="value" @input="updateValue($event.target.value)" :type="type"  :placeholder="placeholder">
        <span class="focus-input100"></span>
    </div>
</template>

<script>
export default {
    name: "Input",
    props:["error","placeholder","type","value"],
    methods: {
        updateValue(value){
            this.$emit("input", value)
        }
    }
}
</script>