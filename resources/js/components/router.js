<template>
  <div>
    <div class="modal-backdrop show" v-if="shouldShow"></div>
    <div class="modal-scrollbar-measure"></div>
    <FadeTransition>
    <div class="modal" v-if="shouldShow" >
     <div class="modal-dialog " :class="modalSize" role="document">
       <div class="modal-content">
         <div class="modal-header bg-primary text-white">
           <h5 class="modal-title text-center">
             <slot name="title"></slot>
           </h5>
           <button type="button" class="close" @click="close" >
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <slot></slot>
         </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" @click="close">
             Close
           </button>
           <slot name="button"></slot>
         </div> -->
       </div>
     </div>
   </div>
 </FadeTransition>
 </div>
</template>

<script>
export default {
  props: {
    show: { default: false },
    size: { default: "large" }
  },
  computed: {
    shouldShow: {
      get() {
        return this.show;
      },
      set(value) {
        this.$emit("update:show", value);

        if (!value) {
          this.$emit("closed");
        }
      }
    },
    modalSize() {
      const sizes = {
        large: "modal-lg",
        medium: "",
        small: "modal-sm"
      };
      return sizes[this.size];
    }
  },

  methods: {
    close() {
      this.shouldShow = false;
    }
  },
  watch: {}
};
</script>
<style scoped>
.modal {
  display: block;
}
</style>
