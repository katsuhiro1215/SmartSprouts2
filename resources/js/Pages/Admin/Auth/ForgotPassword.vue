<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
// Layouts
import AdminAuthLayout from "@/Layouts/AdminAuthLayout.vue";
// Components
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import LoadingIndicator from "@/Components/Loadings/LoadingIndicator.vue";
// Components - Forms
import FormGroup from "@/Components/Forms/FormGroup.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
// validation
import { validateEmail, validateAllFields } from "./_components/Validation";

// Props
defineProps({
  status: {
    type: String,
  },
});

// Form
const form = useForm({
  email: "",
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
  loadingText.value = "Sending Password Reset Link...";
  form.post(route("admin.password.email"), {
    onFinish: () => {
      form.reset("email");
      isLoading.value = false;
      loadingText.value = "";
    },
  });
};
</script>

<template>
  <AdminAuthLayout>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
      Forgot your password? No problem. Just let us know your email address and
      we will email you a password reset link that will allow you to choose a
      new one.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <form @submit.prevent="submit">
      <div class="space-y-4">
        <FormGroup>
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            @blur="validateEmail(form)"
            required
            autofocus
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </FormGroup>
        <FormGroup>
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            :buttonType="submitButtonType"
            type="submit"
          >
            Email Password Reset Link
          </PrimaryButton>
        </FormGroup>
        <FormGroup>
          <Link
            href="/admin/login"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Back to login
          </Link>
        </FormGroup>
      </div>
    </form>
  </AdminAuthLayout>
</template>
