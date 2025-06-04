<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit ">

    {{-- BRAND --}}
    <x-app-brand class="px-5 pt-4" />



    {{-- MENU --}}
    <x-menu activate-by-route class="md:pt-8 ">

      @if ($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
          <x-slot:actions>
            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate
              link="/logout" />
          </x-slot:actions>
        </x-list-item>
      @endif

      <x-menu-item title="Dashboard" icon="o-chart-bar-square" link="/dashboard1" :class="request()->is('/dashboard1') ? 'active' : ''" />
      <x-menu-separator title="Master Data" icon="o-sparkles" />
      <x-menu-item title="Barang" icon="o-cube" link="/barang/" :class="request()->is('\barang') ? 'active' : ''" />
      <x-menu-item title="Cabang" icon="o-building-office" link="/cabang/" :class="request()->is('barang/') ? 'active' : ''" />
      <x-menu-item title="Gudang" icon="o-home-modern" link="/gudang/" :class="request()->is('gudang/') ? 'active' : ''" />
      <x-menu-item title="Pegawai" icon="o-user-circle" link="/pegawai/" :class="request()->is('pegawai/') ? 'active' : ''" />
      <x-menu-item title="Pelanggan" icon="o-users" link="/pelanggan/" :class="request()->is('pelanggan/') ? 'active' : ''" />
      <x-menu-item title="Rak" icon="o-rectangle-group" link="/rak/" :class="request()->is('rak/') ? 'active' : ''" />
      <x-menu-item title="Kategori Rak" icon="o-tag" link="/rak-kategori/" :class="request()->is('rak-karegori/') ? 'active' : ''" />

      <x-menu-separator title="Service" icon="o-sparkles" />
      <x-menu-item title="Tanda Terima Service" icon="o-cube" link="/tanda-terima-service/" :class="request()->is('\tanda-terima-service') ? 'active' : ''" />

      <x-menu-separator title="Role & Permission" icon="o-sparkles" />
      <x-menu-item title="Permission" icon="o-cube" link="/permission/" :class="request()->is('\barang') ? 'active' : ''" />
      <x-menu-item title="Role" icon="o-cube" link="/role/" :class="request()->is('\barang') ? 'active' : ''" />

      <x-menu-separator title="Pengaturan" icon="o-sparkles" />
      <x-menu-sub title="Pengaturan" icon="o-cog-6-tooth">
        <x-menu-item title="Logout" icon="o-tag" link="/logout/" :class="request()->is('admin-logout/') ? 'active' : ''" />
        <x-menu-item title="Setting" icon-right="o-arrow-long-right" link="####" />
        <x-menu-item title="Backup" icon="o-arrow-long-right" link="####" />
      </x-menu-sub>

    </x-menu>
  </x-slot:sidebar>
</div>
