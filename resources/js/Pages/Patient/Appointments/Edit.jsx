import React from "react";
import { Head, useForm, Link } from "@inertiajs/react";

export default function Edit({ appointment, professionals }) {
    const { data, setData, put, processing, errors } = useForm({
        professional_id: appointment.professional_id || "",
        start_time: appointment.start_time || "",
    });

    const submit = (e) => {
        e.preventDefault();
        put(route("patient.appointments.update", appointment.id));
    };

    return (
        <div className="p-6">
            <Head title="Editar Agendamento" />
            <h1 className="text-xl font-bold mb-4">Editar Agendamento</h1>

            <form onSubmit={submit} className="space-y-4 max-w-md">
                <div>
                    <label className="block mb-1">Profissional</label>
                    <select
                        value={data.professional_id}
                        onChange={(e) =>
                            setData("professional_id", e.target.value)
                        }
                        className="w-full border rounded px-3 py-2"
                    >
                        {professionals.map((p) => (
                            <option key={p.id} value={p.id}>
                                {p.first_name} {p.last_name}
                            </option>
                        ))}
                    </select>
                    {errors.professional_id && (
                        <div className="text-red-600 text-sm">
                            {errors.professional_id}
                        </div>
                    )}
                </div>

                <div>
                    <label className="block mb-1">Data e Hora</label>
                    <input
                        type="datetime-local"
                        value={data.start_time}
                        onChange={(e) => setData("start_time", e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.start_time && (
                        <div className="text-red-600 text-sm">
                            {errors.start_time}
                        </div>
                    )}
                </div>

                <div className="flex space-x-2">
                    <button
                        type="submit"
                        disabled={processing}
                        className="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Atualizar
                    </button>

                    <Link
                        href={route("patient.appointments.index")}
                        className="bg-gray-400 text-white px-4 py-2 rounded"
                    >
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    );
}
