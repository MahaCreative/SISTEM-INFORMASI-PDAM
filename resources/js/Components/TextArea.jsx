import React from "react";

export default function TextArea({ title, errors, classname, ...props }) {
    return (
        <div className="">
            <p className="text-xs dark:text-white capitalize">{title}</p>
            <textarea
                {...props}
                className={`text-sm focus:outline-none focus:border-none active:outline-none active:border-none rounded-md dark:text-white dark:bg-gray-950  outline-none w-full ${classname}`}
            ></textarea>
            {errors && (
                <p className="text-xs text-red-600 italic pt-1">{errors}</p>
            )}
        </div>
    );
}
