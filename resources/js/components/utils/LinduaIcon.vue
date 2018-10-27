<template>
    <div v-html="require('!!html-loader!./../../../icons/lindua/svg/' + this.icon + '.svg')" v-once></div>
</template>

<script>
export default {
    props: ['icon','addClass'],
    mounted() {
        this.$el.querySelector("svg").setAttribute("class", this.addClass)
    }
}
</script>