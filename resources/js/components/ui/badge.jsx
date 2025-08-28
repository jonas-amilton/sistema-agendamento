import React from "react";

export function Badge({ children, variant = "scheduled" }) {
    const colors = {
        scheduled: "bg-blue-100 text-blue-800",
        completed: "bg-green-100 text-green-800",
        cancelled: "bg-red-100 text-red-800",
        no_show: "bg-yellow-100 text-yellow-800",
    };

    return (
        <span
            className={`px-3 py-1 text-sm rounded-full font-medium ${
                colors[variant] || colors.scheduled
            }`}
        >
            {children}
        </span>
    );
}
