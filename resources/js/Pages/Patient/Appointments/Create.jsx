import React from "react";
import { Head, useForm } from "@inertiajs/react";

export default function Create({ professionals }) {
    const { data, setData, post, processing, errors } = useForm({
        professional_id: "",
        start_time: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("patient.appointments.store"));
    };

    return (
        <div className="p-6">
            <Head title="Novo Agendamento" />
            <h1 className="text-xl font-bold mb-4">Novo Agendamento</h1>

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
                        <option value="">Selecione</option>
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

                <button
                    type="submit"
                    disabled={processing}
                    className="bg-green-600 text-white px-4 py-2 rounded"
                >
                    Salvar
                </button>
            </form>
        </div>
    );
}
