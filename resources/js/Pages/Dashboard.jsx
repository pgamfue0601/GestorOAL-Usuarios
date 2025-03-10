import CreateUserForm from '@/Components/CreateUserForm';
import ModifyUserForm from '@/Components/ModifyUserForm';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import OALHeaderLayout from '@/Layouts/OALHeaderLayout';
import { Head } from '@inertiajs/react';

const Dashboard = ({ usuariosOAL, contadorUsuarios }) => {
    return (
        <>
            <AuthenticatedLayout>
                <Head title="Índice" />
                <OALHeaderLayout />

                {/* Formulario de creación de usuarios */}
                <CreateUserForm />

                {/* Formulario de modificación de usuarios */}
                <ModifyUserForm
                    contadorUsuarios={contadorUsuarios}
                    usuariosOAL={usuariosOAL}
                />
            </AuthenticatedLayout>
        </>
    );
};

export default Dashboard;
