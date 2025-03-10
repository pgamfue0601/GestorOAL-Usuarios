import { Head, Link } from '@inertiajs/react';

export default function Welcome({ auth }) {
    return (
        <>
            <Head>
                <title>Gestor de Usuarios OAL</title>
            </Head>
            <div>
                <div className="container py-5">
                    <div className="">
                        <header className="border-bottom d-flex align-items-center justify-content-center mb-4 pb-3">
                            <img
                                src="/img/oal.png"
                                className="mx-3"
                                style={{ width: 100 }}
                            />
                            <a className="d-flex align-items-center text-dark text-decoration-none">
                                <span className="fs-1">
                                    Gestor de Usuarios OAL
                                </span>
                            </a>
                        </header>
                        <nav className="d-flex align-items-center justify-content-center">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Índice
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="nav-link fs-5 mx-2"
                                    >
                                        Iniciar sesión
                                    </Link>
                                </>
                            )}
                        </nav>
                    </div>
                </div>
            </div>
        </>
    );
}
