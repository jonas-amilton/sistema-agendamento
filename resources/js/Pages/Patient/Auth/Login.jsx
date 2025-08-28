import React, { useEffect, useState } from "react";
import { Head, useForm } from "@inertiajs/react";
import { route } from "ziggy-js";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
    });

    const [mounted, setMounted] = useState(false);

    useEffect(() => {
        // ativa animação ao montar o componente
        setMounted(true);
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route("patient.login"));
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#e0f2ff] to-[#cfe8ff]">
            <Head title="Login Paciente" />

            <Card
                className={`w-full max-w-md shadow-lg border border-border p-6 transform transition-all duration-700 ${
                    mounted
                        ? "opacity-100 translate-y-0"
                        : "opacity-0 -translate-y-10"
                }`}
            >
                <CardHeader className="text-center mb-4">
                    <CardTitle className="text-2xl font-bold text-primary">
                        Login do Paciente
                    </CardTitle>
                </CardHeader>

                <CardContent>
                    <form onSubmit={submit} className="space-y-4">
                        <div>
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                value={data.email}
                                onChange={(e) =>
                                    setData("email", e.target.value)
                                }
                                className="mt-1 transition focus:ring-2 focus:ring-primary duration-300"
                                placeholder="seu@email.com"
                            />
                            {errors.email && (
                                <p className="text-destructive text-sm mt-1">
                                    {errors.email}
                                </p>
                            )}
                        </div>

                        <div>
                            <Label htmlFor="password">Senha</Label>
                            <Input
                                id="password"
                                type="password"
                                value={data.password}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                                className="mt-1 transition focus:ring-2 focus:ring-primary duration-300"
                                placeholder="••••••••"
                            />
                            {errors.password && (
                                <p className="text-destructive text-sm mt-1">
                                    {errors.password}
                                </p>
                            )}
                        </div>

                        <Button
                            type="submit"
                            disabled={processing}
                            className="w-full mt-2 bg-primary hover:bg-primary/90 transition-colors duration-300"
                        >
                            Entrar
                        </Button>
                    </form>
                </CardContent>
            </Card>
        </div>
    );
}
