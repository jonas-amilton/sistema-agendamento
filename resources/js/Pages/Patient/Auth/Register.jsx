import React from "react";
import { Head, useForm } from "@inertiajs/react";

export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("patient.register"));
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-100">
            <Head title="Cadastro de Paciente" />

            <form
                onSubmit={submit}
                className="bg-white p-6 rounded-lg shadow-md w-96 space-y-4"
            >
                <h1 className="text-xl font-bold">Criar Conta</h1>

                <input
                    placeholder="Nome"
                    value={data.first_name}
                    onChange={(e) => setData("first_name", e.target.value)}
                    className="w-full border rounded px-3 py-2"
                />
                {errors.first_name && (
                    <div className="text-red-600 text-sm">
                        {errors.first_name}
                    </div>
                )}

                <input
                    placeholder="Sobrenome"
                    value={data.last_name}
                    onChange={(e) => setData("last_name", e.target.value)}
                    className="w-full border rounded px-3 py-2"
                />
                {errors.last_name && (
                    <div className="text-red-600 text-sm">
                        {errors.last_name}
                    </div>
                )}

                <input
                    placeholder="Email"
                    type="email"
                    value={data.email}
                    onChange={(e) => setData("email", e.target.value)}
                    className="w-full border rounded px-3 py-2"
                />
                {errors.email && (
                    <div className="text-red-600 text-sm">{errors.email}</div>
                )}

                <input
                    placeholder="Senha"
                    type="password"
                    value={data.password}
                    onChange={(e) => setData("password", e.target.value)}
                    className="w-full border rounded px-3 py-2"
                />
                {errors.password && (
                    <div className="text-red-600 text-sm">
                        {errors.password}
                    </div>
                )}

                <input
                    placeholder="Confirmar Senha"
                    type="password"
                    value={data.password_confirmation}
                    onChange={(e) =>
                        setData("password_confirmation", e.target.value)
                    }
                    className="w-full border rounded px-3 py-2"
                />

                <button
                    type="submit"
                    disabled={processing}
                    className="bg-green-600 text-white px-4 py-2 rounded w-full"
                >
                    Cadastrar
                </button>
            </form>
        </div>
    );
}
