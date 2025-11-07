<template>
  <div v-if="meta" class="pagination">
    <button 
      @click="goToPage(meta.current_page - 1)" 
      :disabled="meta.current_page === 1"
      class="pagination-button">
      Previous
    </button>

    <span>Page {{ meta.current_page }} of {{ meta.last_page }}</span>

    <button 
      @click="goToPage(meta.current_page + 1)" 
      :disabled="meta.current_page === meta.last_page"
      class="pagination-button">
      Next
    </button>
  </div>
</template>

<script>
export default {
  props: {
    meta: Object, 
    routeName: String,
    routeParams: {
      type: Object,
      default: () => ({}),
    },
    additionalParams: {
      type: Object,
      default: () => ({}),
    },
  },
  methods: {
    goToPage(page) {
      if (page > 0 && page <= this.meta.last_page) {
        this.$inertia.get(this.route(this.routeName), {
          page
        });
      }
    },
  },
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: space-between;
  margin-top: 60px;
}

.pagination-button {
  padding: 8px 12px;
  margin: 0 5px;
  cursor: pointer;
}

.pagination-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
