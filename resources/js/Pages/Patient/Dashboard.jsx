import React, { useState } from "react";
import { Head, Link, useForm } from "@inertiajs/react";
import { route } from "ziggy-js";

export default function Dashboard({ patient, appointments, professionals }) {
    const [openModal, setOpenModal] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        professional_id: "",
        start_time: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("patient.appointments.store"), {
            onSuccess: () => {
                reset();
                setOpenModal(false);
            },
        });
    };

    const statusColors = {
        scheduled: "bg-blue-100 text-blue-800",
        completed: "bg-green-100 text-green-800",
        cancelled: "bg-red-100 text-red-800",
        no_show: "bg-yellow-100 text-yellow-800",
    };

    return (
        <div className="p-6 space-y-6">
            <Head title="Painel do Paciente" />
            <h1 className="text-3xl font-bold text-gray-800">
                Olá, {patient?.first_name || "Paciente"} 👋
            </h1>

            {/* Botão de novo agendamento */}
            <div>
                <button
                    onClick={() => setOpenModal(true)}
                    className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow-md transition"
                >
                    + Novo Agendamento
                </button>
            </div>

            {/* Lista de agendamentos */}
            <div>
                <h2 className="text-2xl font-semibold mb-4 text-gray-700">
                    Meus Agendamentos
                </h2>
                <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {appointments.map((app) => (
                        <div
                            key={app.id}
                            className="bg-white rounded-xl shadow p-5 border hover:shadow-lg transition"
                        >
                            <div className="flex justify-between items-start mb-3">
                                <h3 className="text-lg font-semibold text-gray-800">
                                    {app.professional.first_name}{" "}
                                    {app.professional.last_name}
                                </h3>
                                <span
                                    className={`px-3 py-1 text-sm rounded-full font-medium ${
                                        statusColors[app.status]
                                    }`}
                                >
                                    {app.status.replace("_", " ")}
                                </span>
                            </div>
                            <p className="text-gray-600 mb-2">
                                <strong>Data:</strong>{" "}
                                {new Date(app.start_time).toLocaleString(
                                    "pt-BR"
                                )}
                            </p>
                            <Link
                                href={route(
                                    "patient.appointments.edit",
                                    app.id
                                )}
                                className="text-blue-500 hover:underline text-sm"
                            >
                                Editar
                            </Link>
                        </div>
                    ))}
                </div>
            </div>

            {/* Modal de criação */}
            {openModal && (
                <div className="fixed inset-0 bg-white/30 backdrop-blur-sm flex items-center justify-center z-50">
                    <div className="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl animate-slide-in">
                        <h2 className="text-2xl font-bold mb-4 text-gray-800">
                            Novo Agendamento
                        </h2>
                        <form onSubmit={submit} className="space-y-4">
                            <div>
                                <label className="block mb-1 font-medium text-gray-700">
                                    Profissional
                                </label>
                                <select
                                    value={data.professional_id}
                                    onChange={(e) =>
                                        setData(
                                            "professional_id",
                                            e.target.value
                                        )
                                    }
                                    className="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="">Selecione</option>
                                    {professionals.map((p) => (
                                        <option key={p.id} value={p.id}>
                                            {p.first_name} {p.last_name}
                                        </option>
                                    ))}
                                </select>
                                {errors.professional_id && (
                                    <div className="text-red-600 text-sm mt-1">
                                        {errors.professional_id}
                                    </div>
                                )}
                            </div>

                            <div>
                                <label className="block mb-1 font-medium text-gray-700">
                                    Data e Hora
                                </label>
                                <input
                                    type="datetime-local"
                                    value={data.start_time}
                                    onChange={(e) =>
                                        setData("start_time", e.target.value)
                                    }
                                    className="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                                />
                                {errors.start_time && (
                                    <div className="text-red-600 text-sm mt-1">
                                        {errors.start_time}
                                    </div>
                                )}
                            </div>

                            <div className="flex justify-end gap-3 mt-4">
                                <button
                                    type="button"
                                    onClick={() => setOpenModal(false)}
                                    className="px-4 py-2 rounded-lg border hover:bg-gray-100 transition"
                                >
                                    Cancelar
                                </button>
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition"
                                >
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}
