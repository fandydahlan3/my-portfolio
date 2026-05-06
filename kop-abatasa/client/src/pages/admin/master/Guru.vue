<template>
  <div class="card mt-23">
    <div class="card-body">
      <h4 class="card-title">About Me</h4>
      <BootstrapTable
        :columns="columns"
        :data="data"
        :options="options"
      />
    </div>
  </div>
</template>

<script>
  export default {
    name: "GuruPage",
    data () {
      return {
        columns: [
          {
            title: 'Item ID',
            field: 'id'
          },
          {
            field: 'name',
            title: 'Item Name'
          },
          {
            field: 'price',
            title: 'Item Price'
          }
        ],
        data: [
          {
            id: 1,
            name: 'Item 1',
            price: '$1'
          }
        ],
        options: {
          search: true,
          showColumns: true
        }
      }
    }
  }
</script>

<style scoped>

</style>
