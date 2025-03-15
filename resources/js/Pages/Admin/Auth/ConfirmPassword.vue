<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
// Layouts
import AdminAuthLayout from "@/Layouts/AdminAuthLayout.vue";
// Components
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import LoadingIndicator from "@/Components/Loadings/LoadingIndicator.vue";
// Components - Forms
import FormGroup from "@/Components/Forms/FormGroup.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import InputError from "@/Components/Form/InputError.vue";
// validation
import { validatePassword, validateAllFields } from "./_components/Validation";

// Forms
const form = useForm({
  password: "",
});

// Loading
const isLoading = ref(false);
const loadingText = ref("");

// ボタンの状態
const submitButtonType = computed(() => {
  return form.email && !form.processing ? "primary" : "secondary";
});

// フォームの送信
const submit = async () => {
  validateAllFields(form);
  isLoading.value = true;
  loadingText.value = "Confirming password...";
  form.post(route("password.confirm"), {
    onFinish: () => {
      form.reset();
      isLoading.value = false;
      loadingText.value = "";
    },
  });
};
</script>

<template>
  <AdminAuthLayout>
    <Head title="Confirm Password" />

    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password
      before continuing.
    </div>

    <form @submit.prevent="submit">
      <FormGroup>
        <InputLabel for="password" value="Password" />
        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          @blur="validatePassword(form)"
          required
          autocomplete="current-password"
          autofocus
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </FormGroup>
      <FormGroup>
        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          :buttonType="submitButtonType"
          type="submit"
        >
          Confirm
        </PrimaryButton>
      </FormGroup>
    </form>
  </AdminAuthLayout>
</template>
