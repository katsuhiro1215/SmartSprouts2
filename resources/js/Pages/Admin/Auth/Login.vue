<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
// Layouts
import AdminAuthLayout from "@/Layouts/AdminAuthLayout.vue";
// Components
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import LoadingIndicator from "@/Components/Loadings/LoadingIndicator.vue";
// Components - Forms
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import FormGroup from "@/Components/Forms/FormGroup.vue";
// validation
import {
  validateEmail,
  validatePassword,
  validateAllFields,
} from "./_components/Validation";

// Props
defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

// Form
const form = useForm({
  email: "",
  password: "",
  remember: false,
});

// Loading
const isLoading = ref(false);
const loadingText = ref("");

// ボタンの状態
const submitButtonType = computed(() => {
  return form.email && form.password && !form.processing
    ? "primary"
    : "secondary";
});

// フォームの送信
const submit = async () => {
  validateAllFields(form);
  isLoading.value = true;
  loadingText.value = "ログイン中...";
  form.post(route("admin.login"), {
    onFinish: () => {
      form.reset("password");
      isLoading.value = false;
      loadingText.value = "";
    },
  });
};
</script>

<template>
  <AdminAuthLayout>
    <Head title="Log in" />

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
            placeholder="メールアドレスを入力してください。"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </FormGroup>
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
            placeholder="パスワードを入力してください。"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </FormGroup>
        <FormGroup>
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="form.remember" />
            <span class="ms-2 text-sm text-gray-600">Remember me</span>
          </label>
        </FormGroup>
        <FormGroup>
          <Link
            v-if="canResetPassword"
            :href="route('admin.password.request')"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Forgot your password?
          </Link>
        </FormGroup>
        <FormGroup>
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            :buttonType="submitButtonType"
            type="submit"
            >Log in</PrimaryButton
          >
        </FormGroup>
        <FormGroup>
          <Link
            href="/register"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Don't have an account? Register
          </Link>
        </FormGroup>
      </div>
    </form>
  </AdminAuthLayout>
</template>
