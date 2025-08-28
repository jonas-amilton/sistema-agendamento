import React, { useEffect } from "react";

export function Toast({ message, type = "success", onClose }) {
    const colors = {
        success: "bg-green-500 text-white",
        error: "bg-red-500 text-white",
        info: "bg-blue-500 text-white",
    };

    useEffect(() => {
        const timer = setTimeout(onClose, 4000); // fecha após 4s
        return () => clearTimeout(timer);
    }, [onClose]);

    return (
        <div
            className={`fixed top-5 right-5 px-4 py-2 rounded shadow-lg animate-slide-in ${colors[type]}`}
        >
            {message}
        </div>
    );
}
