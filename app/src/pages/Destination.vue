<template>
  <div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-gray-900">
          Destinations
        </h1>
        <p class="text-sm text-gray-500 mt-0.5">
          {{ rows.length }} total destinasi
        </p>
      </div>

      <button
        @click="openAdd"
        class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-green-600 text-white text-sm font-semibold hover:bg-green-700 transition-colors"
      >
        <Plus class="w-4 h-4" />
        Tambah
      </button>
    </div>

    <!-- Table container -->
    <div
      class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden"
    >
      <!-- Search -->
      <div class="p-4 border-b border-gray-50">
        <div class="relative max-w-xs">
          <Search
            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
          />

          <input
            v-model="query"
            placeholder="Cari destinasi..."
            class="pl-9 pr-4 py-2 rounded-xl border border-gray-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500"
          />
        </div>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
              <th class="text-left px-4 py-3 w-10">#</th>
              <th class="text-left px-4 py-3">Nama</th>
              <th class="text-left px-4 py-3">Provinsi</th>
              <th class="text-left px-4 py-3 hidden lg:table-cell">
                Deskripsi
              </th>
              <th class="text-left px-4 py-3 hidden md:table-cell">
                Gambar
              </th>
              <th class="px-4 py-3 w-24"></th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-50">
            <tr
              v-if="filtered.length === 0"
            >
              <td
                colspan="6"
                class="text-center py-12 text-gray-400"
              >
                Tidak ada data
              </td>
            </tr>

            <tr
              v-for="r in filtered"
              :key="r.id"
              class="hover:bg-gray-50/50 transition-colors"
            >
              <td class="px-4 py-3 text-gray-400">
                {{ r.id }}
              </td>

              <td class="px-4 py-3 font-medium text-gray-900">
                {{ r.name }}
              </td>

              <td class="px-4 py-3 text-gray-600">
                {{ r.province }}
              </td>

              <td
                class="px-4 py-3 text-gray-500 max-w-xs truncate hidden lg:table-cell"
              >
                {{ r.description }}
              </td>

              <td class="px-4 py-3 hidden md:table-cell">
                <img
                  v-if="r.image_url"
                  :src="r.image_url"
                  class="w-14 h-10 rounded-lg object-cover bg-gray-100"
                />
                <span v-else class="text-gray-300">—</span>
              </td>

              <td class="px-4 py-3">
                <div class="flex items-center justify-end gap-1">
                  <button
                    @click="openEdit(r)"
                    class="p-1.5 rounded-lg hover:bg-blue-50 text-gray-400 hover:text-blue-600"
                  >
                    <Pencil class="w-3.5 h-3.5" />
                  </button>

                  <button
                    @click="openDelete(r)"
                    class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600"
                  >
                    <Trash2 class="w-3.5 h-3.5" />
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add/Edit Modal -->
    <Modal
      v-if="modal === 'add' || modal === 'edit'"
      :title="modal === 'add' ? 'Tambah Destinasi' : 'Edit Destinasi'"
      @close="closeModal"
    >
      <div class="flex flex-col gap-4">
        <Field label="Nama Destinasi">
          <input
            v-model="form.name"
            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm"
            placeholder="cth. Raja Ampat"
          />
        </Field>

        <Field label="Provinsi">
          <input
            v-model="form.province"
            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm"
            placeholder="cth. Papua Barat"
          />
        </Field>

        <Field label="Deskripsi">
          <textarea
            v-model="form.description"
            rows="3"
            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm resize-none"
            placeholder="Deskripsi singkat..."
          />
        </Field>

        <Field label="URL Gambar">
          <input
            v-model="form.image_url"
            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm"
            placeholder="https://..."
          />
        </Field>

        <img
          v-if="form.image_url"
          :src="form.image_url"
          class="w-full h-40 rounded-xl object-cover bg-gray-100"
        />

        <div class="flex gap-3 pt-2">
          <button
            @click="closeModal"
            class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-700 text-sm"
          >
            Batal
          </button>

          <button
            @click="save"
            :disabled="!form.name || !form.province"
            class="flex-1 px-4 py-2.5 rounded-xl bg-green-600 text-white text-sm font-semibold disabled:opacity-40"
          >
            Simpan
          </button>
        </div>
      </div>
    </Modal>

    <!-- Delete -->
    <DeleteConfirm
      v-if="modal === 'delete' && selected"
      :name="selected.name"
      @confirm="remove"
      @close="closeModal"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";

import { Plus, Search, Pencil, Trash2 } from "lucide-vue-next";

import Modal from "@/components/ui/Modal.vue";
import Field from "@/components/ui/Field.vue";
import DeleteConfirm from "@/components/ui/DeleteConfirm.vue";

import { seedDestinations } from "@/data/destinations";
import type { Destination } from "@/types/destination";

type DestinationForm = Omit<Destination, "id">;

const blank: DestinationForm = {
  name: "",
  province: "",
  description: "",
  image_url: "",
};

const rows = ref<Destination[]>([...seedDestinations]);
const query = ref("");
const modal = ref<"add" | "edit" | "delete" | null>(null);
const selected = ref<Destination | null>(null);
const form = ref<DestinationForm>({ ...blank });

const filtered = computed(() => {
  const q = query.value.toLowerCase();

  return rows.value.filter(
    (r) =>
      r.name.toLowerCase().includes(q) ||
      r.province.toLowerCase().includes(q)
  );
});

function openAdd() {
  form.value = { ...blank };
  selected.value = null;
  modal.value = "add";
}

function openEdit(r: Destination) {
  selected.value = r;
  form.value = {
    name: r.name,
    province: r.province,
    description: r.description,
    image_url: r.image_url,
  };
  modal.value = "edit";
}

function openDelete(r: Destination) {
  selected.value = r;
  modal.value = "delete";
}

function closeModal() {
  modal.value = null;
}

function save() {
  if (modal.value === "add") {
    rows.value.push({
      ...form.value,
      id: Date.now(),
    });
  }

  if (modal.value === "edit" && selected.value) {
    rows.value = rows.value.map((r) =>
      r.id === selected.value!.id
        ? { ...form.value, id: r.id }
        : r
    );
  }

  closeModal();
}

function remove() {
  if (selected.value) {
    rows.value = rows.value.filter(
      (r) => r.id !== selected.value!.id
    );
  }
  closeModal();
}
</script>