import React, { useState } from "react";
import { Head, useForm } from "@inertiajs/react";
import { route } from "ziggy-js";

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
        // remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("patient.login"));
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-100">
            <Head title="Login Paciente" />

            <form
                onSubmit={submit}
                className="bg-white p-6 rounded-lg shadow-md w-96 space-y-4"
            >
                <h1 className="text-xl font-bold">Login do Paciente</h1>

                <div>
                    <label className="block mb-1">Email</label>
                    <input
                        type="email"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.email && (
                        <div className="text-red-600 text-sm">
                            {errors.email}
                        </div>
                    )}
                </div>

                <div>
                    <label className="block mb-1">Senha</label>
                    <input
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
                </div>

                <button
                    type="submit"
                    disabled={processing}
                    className="bg-blue-600 text-white px-4 py-2 rounded w-full"
                >
                    Entrar
                </button>
            </form>
        </div>
    );
}
