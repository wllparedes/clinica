<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 bg-secondary-900"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto
    dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            <x-sidebar-link route="admin.dashboard" icon="home" label="Home" />

            <x-sidebar-link route="admin.staff" icon="users" label="Staff" />

            <x-sidebar-link route="admin.patients" icon="user" label="Patients" />

            <x-sidebar-link route="admin.appointments" icon="annotation" label="Appointment requests" />

            <x-sidebar-link route="admin.medical-requests" icon="calendar" label="Medical appointments" />

            <x-sidebar-link route="admin.products" icon="puzzle" label="Products" />

            <x-sidebar-link route="admin.specialties" icon="beaker" label="Specialties" />

        </ul>
    </div>
</aside>
